<script wire:ignore>
    app.controller('myCtrl', function ($scope, $http) {
        $scope.items = <?php echo json_encode($items->pluck('id')->toArray()); ?>;
        $scope.selected_items = [];
        $scope.is_submited = false;
        $scope.bulk_action = null;

        $scope.CheckUnCheckBoxes = function (item, value){
            if (Array.isArray(item)) {
                $('input:checkbox').prop('checked', value);
            }else {
                $('#bulk_checkbox_' + item).prop('checked', value);
                if ($scope.items.length == $scope.selected_items.length){
                    $('input:checkbox').prop('checked', value);
                }else {
                    $('#checkAll').prop('checked', false);
                }
            }
        }

        $scope.AddItemsToBulkAction = function (items, value) {
            if (Array.isArray(items)) {
                if (value) {
                    for (const i in items) {
                        $scope.selected_items.push(items[i]);
                    }
                } else {
                    $scope.selected_items = [];
                }

            } else {
                if (value) {
                    $scope.selected_items.push(items);
                } else {
                    var index = $scope.selected_items.indexOf(items);
                    $scope.selected_items.splice(index, 1);
                }
            }

            $scope.CheckUnCheckBoxes(items, value);
        }

        $scope.SubmitBulkActionConfirm = function () {

            if (!$scope.bulk_action) {
                showToast('لطفا یک عملیات انتخاب کنید!', 'error');
                return;
            }

            if ($scope.selected_items.length == 0) {
                showToast('حداقل یک آیتم را برای انجام عملیات انتخاب کنید!', 'error');
                return;
            }

            Swal.fire({
                title: 'آیا از اجرای این عملیات اطیمان دارید؟',
                text: "این عملیات غیرقابل بازگشت است!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'بله',
                cancelButtonText: 'لغو',
            }).then((result) => {
                if (result.isConfirmed) {
                @this.call('SubmitBulkAction', $scope.selected_items, $scope.bulk_action, "{{ str_replace('\\', '\\\\', $model) }}");

                }
            })

        }

        $scope.ChangeStatus = function () {
            $scope.is_submited = true;

            var data = {
                "is_approved": $scope.is_approved
            };

            $http.post(`/api/owners/status/change/${$scope.id}`, data).then(res => {
                showToast('وضعیت آیتم مورد نظر با موفقیت تغییر کرد.', 'success');
                $scope.is_submited = false;
                setTimeout(() => {
                    location.reload()
                }, 1000)
            }).catch(err => {
                $scope.is_submited = false;
                showToast('خطایی رخ داد.', 'error');
            });
        }

        window.addEventListener('itemBulkActionsUpdated', event => {
            $scope.is_submited = false;
            $scope.selected_items = [];
            $scope.bulk_action = null;
            for (const item in $scope.items) {
                $('#bulk_checkbox_' + $scope.items[item]).prop('checked', false);
            }
            $('#checkAll').prop('checked', false);
            showToast(event.detail['message'], 'success');
        });


    @this.on('triggerChangeStatusModal', (item_id, name, all_items) => {
        var value;
        if ($('#' + name).is(':checked')){
            value = true;
        }else {
            value = false;
        }

        $scope.items = all_items;

        $scope.AddItemsToBulkAction(item_id, value);
    });

    });
</script>
