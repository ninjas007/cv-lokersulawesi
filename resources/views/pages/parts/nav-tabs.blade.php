@foreach ($steps as $step)
    <li class="nav-item flex-fill" role="presentation">
        <a class="nav-link {{ $step['id'] == 1 ? 'active' : '' }} rounded-circle mx-auto d-flex align-items-center justify-content-center" href="#step{{ $step['id'] }}"
            id="step{{ $step['id'] }}-tab" data-toggle="tab" data-target="#step{{ $step['id'] }}" role="tab" aria-controls="step{{ $step['id'] }}" aria-selected="true">
            <i class="{{ $step['icon'] }}"></i>
        </a>
    </li>
@endforeach
