@if($paginator->hasPages())
    <nav aria-label="Page navigation example">
        <ul class="pagination">

            @if ($paginator->onFirstPage())
                <li class="page-item disabled" disabled style="cursor: no-drop !important;" id="previousPage_diabled">
                    <a class="page-link" aria-label="Previous">
{{--                        <span aria-hidden="true">&laquo;</span>--}}
{{--                        <span class="sr-only">Previous</span>--}}
                        قبلی
                    </a>
                </li>
            @else
                <li class="page-item" style="cursor: pointer !important;" id="previousPage">
                    <a class="page-link" wire:click="previousPage" wire:loading.attr="disabled" aria-label="Previous">
{{--                        <span aria-hidden="true">&laquo;</span>--}}
{{--                        <span class="sr-only">Previous</span>--}}
                        قبلی
                    </a>
                </li>
            @endif

            @foreach ($elements as $element)
                @if(is_array($element))
                    @foreach($element as $page => $url)
                        @if($page ==  $paginator->currentPage())
                            <li style="cursor: pointer !important;" class="page-item active" id="current"><a class="page-link" wire:loading.attr="disabled"
                                                                                                wire:click="gotoPage({{$page}})">{{$page}} <span class="sr-only">(current)</span></a>
                            </li>
                        @else
                            <li style="cursor: pointer !important;" class="page-item"><a wire:loading.attr="disabled" class="page-link"
                                                            wire:click="gotoPage({{$page}})">{{$page}}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li class="page-item" style="cursor: pointer !important;" id="nextPage">
                    <a class="page-link" wire:click="nextPage" wire:loading.attr="disabled" aria-label="Next">
{{--                        <span aria-hidden="true">&raquo;</span>--}}
{{--                        <span class="sr-only">Next</span>--}}
                        بعدی
                    </a>
                </li>
            @else
                <li style="cursor: no-drop !important;" class="page-item disabled" disabled id="nextPage_disabled">
                    <a class="page-link" aria-label="Next">
{{--                        <span aria-hidden="true">&raquo;</span>--}}
{{--                        <span class="sr-only">Next</span>--}}
                        بعدی
                    </a>
                </li>
            @endif
        </ul>
    </nav>
@endif
