<?php function handle($number): int
{
    return match (true) {
        $number > 0.1 => 2,
        $number > 0.01 => 3,
        $number > 0.001 => 4,
        $number > 0.0001 => 5,
        $number > 0.00001 => 6,
        $number > 0.000001 => 7,
        default => 8,
    };
}
?>

<x-app-layout>
    @if (!Auth::check())
        @include('partials.hero')
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

{{--                Table   --}}

                <div class="flex flex-col">
                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="overflow-hidden">
                                <div class="inline-flex mx-4">
                                    <div class="mx-4">
                                        Global marketcap: {{ number_format($globalMetrics->getTotalMarketCap(), 2) }}
                                    </div>
                                    <div class="mx-4">
                                        Total volume 24H: {{ number_format($globalMetrics->getTotalVolume24H(), 2) }}

                                    </div>
                                    <div class="mx-4">
                                        BTC dominance: {{ number_format($globalMetrics->getBtcDominance(), 2) }}
                                    </div>
                                    <div class="mx-4">
                                        Eth dominance: {{ number_format($globalMetrics->getEthDominance(), 2) }}
                                    </div>
                                    <div class="mx-4">
                                        Total coins: {{ $globalMetrics->getTotalCryptocurrencies() }}
                                    </div>
                                    <div class="mx-4">
                                        Active coins: {{ $globalMetrics->getActiveCryptocurrencies() }}

                                    </div>
                                </div>

                                <div>
                                    <form action="/user/transactions">
                                        <div class="relative border-2 border-gray-100  mt-12 m-4 rounded-lg">
                                            <div class="absolute top-4 left-3">
                                                <i class="fa fa-search text-gray-400 z-20 hover:text-gray-500"></i>
                                            </div>
                                            <input type="text" name="search" class="h-14 w-full pl-10 pr-20 rounded-lg z-0 focus:shadow focus:outline-none"
                                                   placeholder="Search..." />
                                            <div class="absolute top-2 right-2">
                                                <button type="submit" class="h-10 w-20 text-white rounded-lg bg-blue-500 hover:bg-blue-600">
                                                    Search
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <table class="min-w-full">
                                    <thead class="bg-blue-400 border-b">
                                    <tr>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            #
                                        </th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            Symbol
                                        </th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            Name
                                        </th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            Price
                                        </th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            1h
                                        </th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            24h
                                        </th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            7d
                                        </th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            Market Cap
                                        </th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            Buy/Sell
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($coins as $coin)
                                        <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $coin['cmc_rank'] }}</td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                <a href="/listings/?symbol={{$coin['symbol']}}">
                                                    <img class="inline-block h-8 w-8 rounded-full" src="https://s2.coinmarketcap.com/static/img/coins/64x64/{{ $coin['crypto_id'] }}.png" alt="{{ $coin['symbol'] }}">
                                                    {{$coin['symbol']}}
                                                </a>
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                {{ $coin['name'] }}
                                            </td>

                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                {{number_format($coin['price'], 2)}}
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap
      {{ $coin['percent_change_1h'] >=0 ? 'text-green-800' : 'text-red-700' }}">
                                                {{number_format($coin['percent_change_1h'], 2)}}
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap
      {{ $coin['percent_change_24h'] >=0 ? 'text-green-800' : 'text-red-700' }}">
                                                {{number_format($coin['percent_change_24h'], 2)}}
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap
      {{ $coin['percent_change_7d'] >=0 ? 'text-green-800' : 'text-red-700' }}">
                                                {{number_format($coin['percent_change_7d'], 2)}}
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap ">
                                                {{number_format($coin['market_cap'], 2)}}
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                <a href="/listings/?symbol={{ $coin['symbol'] }}">
                                                    <button
                                                        class="bg-blue-100 hover:bg-blue-700 hover:text-white font-bold py-2 px-4 rounded-full">
                                                        BUY/SELL
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <span>{{$coins->links()}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        @if (!Auth::check())
            <div class="relative h-16 bg-rose-200 flex flex-col justify-center align-center text-center space-y-4 mb-4">
                <p class="text-2xl text-gray-800 font-bold my-4">
                    You must be <a href="/login" class="hover:text-blue-800">logged in</a> or <a href="/register" class="hover:text-blue-800">register</a> to buy crypto!
                </p>
            </div>
        @endif
</x-app-layout>
