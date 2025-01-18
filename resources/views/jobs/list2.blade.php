@foreach ($jobs as $job)
    <div class="card p-2 mb-3">
        <div class="row g-3  list-job" style="border-radius: 5px">
            <div class="col-3 px-2">
                <a href="{{ url('lowongan') }}/{{ $job->slug }}">
                    <img src="{{ $job->image }}" alt="Image" class="img-fluid w-100"
                        style="width: 100%; height: 100px; object-fit: contain">
                </a>
            </div>
            <div class="col-9 d-flex flex-column">
                <a href="{{ url('lowongan') }}/{{ $job->slug }}">
                    <div class="d-flex justify-content-between">
                        <div class="text-muted mb-3 bold h5" style="word-break: break-all">
                            {!! ucfirst($job->title) !!}
                        </div>
                        {{-- <div>
                                        @foreach (json_decode($job->job_types, true) as $jobType)
                                            {!! $jobType !!}
                                        @endforeach
                                    </div> --}}
                    </div>
                    <div class="mb-2">
                        <div class="text-muted ">
                            <i class="fa fa-building"></i>
                            {{ $job->company_name }}
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="text-muted">
                            <i class="fa fa-map-marker"></i>
                            {{ implode(',', json_decode($job->location, true)) }}
                        </div>
                    </div>
                    @if ($job->salary != '')
                        <div class="mb-2">
                            <div class="text-muted">
                                <i class="fas fa-money-bill"></i> Gaji: {{ $job->salary }}
                            </div>
                        </div>
                    @endif
                </a>

                <div class="mt-auto">
                    <div class="d-flex justify-content-between align-items-end">
                        <small class="text-muted">
                            Dipublikasikan {{ $job->publish_on_date ? \Carbon\Carbon::parse($job->publish_on_date)->diffForHumans() : $job->publish_on }}
                        </small>
                        <div class="btn btn-info btn-sm" title="Bagikan Lowongan" data-toggle="modal"
                            data-target="#share" onclick="showModal(`{{ url('lowongan') }}/{{ $job->slug }}`)">
                            <i class="fa fa-share"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
