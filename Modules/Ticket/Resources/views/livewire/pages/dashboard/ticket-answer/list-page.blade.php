<div class="row">

    @if (session()->has('message'))
        <script>
            Swal.fire({
                title: "تبریک ! 🥳",
                icon: 'success',
                text: '{{ session('message') }}',
                type: "success",
                cancelButtonColor: 'var(--primary)',
                confirmButtonText: 'اوکی',
            })
        </script>
    @endif

    <div class="col-lg-12">
        <div class="card-box">
            <div class="card-block">
                <h4 class="card-title">تیکت {{ $item->title ?: '---'  }}</h4>

                <hr>

                <div class="container">
                    <div class="row mt-5" style="float: right!important; margin-bottom: 50px !important">
                        <div class="col-12">
                            <h2 class="text-right mb-3">
                                موضوع: {{ $item->title ?: '---' }}
                            </h2>
                            <h4 class="text-right mb-3">
                                فرستنده: {{ $item->user ? $item->user->fullname() : '---' }}
                            </h4>
                            <p class="text-right">
                                {{ $item->text ?: '---' }}
                            </p>
                            @if($item->file)
                                <a target="_blank" href="{{ $item->file ?: '---' }}" class="text-info ">فایل ضمیمه</a>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2">&nbsp;</div>

                        @foreach($items as $item)
                            <div class="col-md-12">
                                <div class="row space-16">&nbsp;</div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="thumbnail">
                                            <div class="caption text-center">
                                                <h4 id="thumbnail-label">
                                                    @if($item->user_id == auth()->id)
                                                        <a>{{ $item->user->fullname() }}</a>
                                                    @else
                                                        {{ $item->user->fullname() }}
                                                    @endif
                                                </h4>
                                                <p>
                                                    <i class="glyphicon glyphicon-calendar light-red lighter bigger-120"></i>&nbsp;{{ item.created_at | jdate }}
                                                </p>
                                                <div class="thumbnail-description smaller"
                                                     style="word-wrap: break-word; margin-top: 30px!important;">
                                                    {{ $item->text }}
                                                </div>
                                            </div>
                                            @if($item->file)
                                                <a target="_blank" href="{{ $item->file }}" class="text-info ">فایل
                                                    ضمیمه</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">&nbsp;</div>
                            </div>
                        @endforeach

                    </div>

                    @if(count($answers) > 0)
                        <hr class="m-t-5">
                    @endif
                    <div class="row my-4">
                        <div class="col-12 my-3 text-justify">
                            <form method="post" enctype="multipart/form-data"
                                  action="{% url 'tickets-answers-create' object.id %}">

                                @csrf

                                <div class="row">
                                    <div class="form-group col-md-12 mt-3">
                                        <label class="form-label"
                                               for="id_text">متن پاسخ:</label>

                                        <textarea id="id_text" type="text" name="text"
                                                  class="form-control" required rows="8"
                                                  placeholder="متن پاسخ را وارد کنید">@if(old('text')){{ old('text') }}@endif</textarea>

                                        @error('text')
                                        <p><small class="form-control-feedback"
                                                  style="color:red">{{ $message }}</small></p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="m-1-25 m-b-20" style="float: left !important;">
                                        <a href="{{ url()->previous() }}"
                                           class="btn btn-danger btn-border-radius waves-effect">
                                            بازگشت
                                        </a>
                                        <button class="btn btn-info btn-border-radius waves-effect" type="submit">
                                            ثبت
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

</div>
