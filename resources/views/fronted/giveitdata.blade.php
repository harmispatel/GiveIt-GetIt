@foreach ($data as $datas)
    <div class="col-md-4">

        <div class="get_detalis_inr">
            <div class="get_detalis_img text-center">
                <div class="get_img"> <img src="{{ $datas->media == null ? asset('/img/requirement/Noimage.jpg') : asset($datas->media['path']) }}" alt="Image" width="150"></div>
            </div>
            <div class="get_detalis_info">
                <label> {{ $datas->user['name'] }}</label>
                <p>Requirment: {{ $datas->categories['name'] }}</p>
                <p>MO : {{ $datas->user['mobile'] }}</p>
                <p>Email : <a href="mailto:{{ $datas->user['email'] }}"> {{ $datas->user['email'] }}</a></p>
            </div>
            <button type="button" class="btn btn-dark" ><a href="{{ route('viewdetail', $datas['id']) }}">View Detial</a></button>
        </div>
    </div>
@endforeach
