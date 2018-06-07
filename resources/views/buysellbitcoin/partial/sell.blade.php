<tr class="clickable-row with-tags tr_2">
    <td class=" tr_2_td">
        {{-- <span class="flag_span"></span> --}}
        <img src="{{ asset('storage/'.$offer->country->flag) }}" height="12" width="18" alt="">
        <i class="fa fa-circle {{ $offer->author->isOnline()?'online':'offline' }}" aria-hidden="true"></i>
        <a href="#">{{ $offer->author->name }}</a>
        <span class="span_number">
            <strong>+32</strong>
        </span>
        <span class="span_seen">
            @if ($offer->author->isOnline()) Seen just now @else {{$offer->author->last_seen->diffForHumans() }} @endif

        </span>
    </td>
    <td>
        <strong class="bank">{{ $offer->paymentmethod->name }}
            <span class="bank_span">- transfer</span>
        </strong>
        @foreach ($offer->tag as $tag)
            <a class="bank_a" href="#">{{ $tag->name }}</a>
        @endforeach
        
    </td>
    <td>
        <h4 class="usd_h4">{{ $offer->min_ammount.'-'.$offer->max_ammount }}
            <span class="usd_span">{{ $offer->country->currency_code }}</span>
        </h4>
    </td>
    <td>
        <h4 class="usd_h4">{{ number_format($offer->offer_price,2) }}
            <span class="usd_span">{{ $offer->country->currency_code }}</span>
        </h4>
    </td>
    <td>
        <a class="bye_a" href="{{ route('single.offer',['offer_slug' => $offer->offer_slug]) }}">Sell</a>
    </td>
</tr>