$scope.items = <?php echo json_encode($items->pluck('id')->toArray() ); ?>;
$scope.selected_items = [];
$scope.is_submited = false;
$scope.bulk_action = null;

$scope.AddItemsToBulkAction = function (items, value){
if (Array.isArray(items)){
if (value){
for(const i in items){
$scope.selected_items.push(items[i]);
}
}
else {
$scope.selected_items = [];
}

}else {
if (value){
$scope.selected_items.push(items);
}
else {
var index = $scope.selected_items.indexOf(items);
$scope.selected_items.splice(index,1);
}
}

}

$scope.SubmitBulkActionConfirm = function() {

if (!$scope.bulk_action){
showToast('لطفا یک عملیات انتخاب کنید!', 'error');
return;
}

if ($scope.selected_items.length == 0){
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
cancelButtonText:'لغو',
}).then((result) => {
if (result.isConfirmed) {
$scope.SubmitBulkAction();
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


$scope.SubmitBulkAction = function() {
var data = {
    'action': $scope.bulk_action,
    'model': '{{ $model }}',
    'items': $scope.selected_items,
};

$scope.is_submited = true;

$http.post(`/api/admin/bulk/actions`, data).then(res => {
showToast(res['data']['data'], 'success');
$scope.is_submited = false;
setTimeout(() => {
location.reload()
}, 1000)
}).catch(err => {
$scope.is_submited = false;
showToast(res['data']['data'], 'error');
});
}
