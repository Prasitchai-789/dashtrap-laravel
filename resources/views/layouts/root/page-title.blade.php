<!-- Page Title Start -->
<div class="mb-2 card font-anuphan">
    <div class="flex items-center justify-between card-header">
        <h5 class="mt-2 text-lg font-medium text-default-950 font-prompt">{{ $title }}</h5>
    </div>
    <div class="card-body">
        <ol class="flex items-center min-w-0 whitespace-nowrap" aria-label="Breadcrumb">
            <i class="flex-shrink-0 i-tabler-home text-lg/3 me-2"></i>
            <li class="text-sm text-default-600">
                <a class="flex items-center font-medium hover:text-primary-600" href="#">
                    Home
                    <i class="flex-shrink-0 text-lg i-tabler-chevron-right text-default-600"></i>
                </a>
            </li>

            <li class="text-sm text-default-600">
                <a class="flex items-center font-medium hover:text-primary-600" href="#">
                    {{ $subtitle }}
                    <i class="flex-shrink-0 text-lg i-tabler-chevron-right text-default-600"></i>
                </a>
            </li>

            <li class="text-sm font-medium font-semibold truncate text-default-800" aria-current="page">
                {{ $title }}
            </li>
        </ol>
    </div>
</div>
<!-- Page Title End -->
