@foreach ($jobs as $job)
    <div class="card p-2 mb-3">
        <div class="row g-0  list-job" style="border-radius: 5px">
            <div class="col-2 px-2">
                <a href="{{ url('lowongan') }}/{{ $job['slug'] }}">
                    <img src="{{ $job['image'] }}" alt="Image" class="img-fluid w-100"
                        style="width: 100%; height: 100px; object-fit: contain">
                </a>
            </div>
            <div class="col-10 d-flex flex-column">
                <a href="{{ url('lowongan') }}/{{ $job['slug'] }}">
                    <div class="d-flex justify-content-between">
                        <div class="text-muted mb-3 bold h5">
                            {!! $job['title'] !!}
                        </div>
                        <div>
                            @foreach ($job['job_types'] as $jobType)
                                {!! $jobType['html_name'] !!}
                            @endforeach
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="text-muted ">
                            <i class="fa fa-building"></i>
                            {{ $job['company'] }}
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="text-muted">
                            <i class="fa fa-map-marker"></i>
                            {{ $job['location'] }}
                        </div>
                    </div>
                    @if ($job['gaji'] != '')
                        <div class="mb-2">
                            <div class="text-muted">
                                <i class="fas fa-money-bill"></i> Gaji: {{ $job['gaji'] }}
                            </div>
                        </div>
                    @endif
                </a>

                <div class="mt-auto">
                    <div class="d-flex justify-content-between align-items-end">
                        <small class="text-muted">Dipublikasikan
                            {{ $job['publish_on'] }}
                        </small>
                        <div class="btn btn-info btn-sm" title="Bagikan Lowongan" data-toggle="modal"
                            data-target="#share" onclick="showModal(`{{ url('lowongan') }}/{{ $job['slug'] }}`)">
                            <i class="fa fa-share"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
