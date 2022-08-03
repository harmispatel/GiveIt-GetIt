@foreach ($data as $items)
    <div class="col-md-4">
        <div class="get_detalis_inr">
            <div class="get_detalis_img text-center">
                <div class="get_img">
                    <a href="{{ route('getitview', $items['id']) }}">
                         <img src="{{ $items->media == null ? asset('/img/requirement/Noimage.jpg') : asset($items->media['path']) }}" alt="Image" ></div>
                         </a>
            </div>
            <div class="get_detalis_info">
                <label> {{ $items->user['name'] }}</label>
                <p>Requirment: {{ $items->categories['name'] }}</p>
                <p>MO : {{ $items->user['mobile'] }} </p>
                <p>Email : <a href="mailto:{{ $items->user['email'] }}"> {{ $items->user['email'] }}</a></p>
            </div>
        </div>
    </div>
@endforeach
