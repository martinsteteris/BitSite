<x-app-layout>
    @if (!Auth::check())
        @include('partials.hero')
    @endif
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                     <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full">

{{--                        THEAD   --}}

                        <thead class="bg-blue-400 border-b">
                        <tr>
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
                        </tr>
                        </thead>

{{--                        TBODY      --}}

                        <tbody>

                            <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        <img class="inline-block h-8 w-8 rounded-full" src="https://s2.coinmarketcap.com/static/img/coins/64x64/{{ $coin->getId() }}.png" alt="{{ $coin->getSymbol() }}">
                                        {{$coin->getSymbol()}}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{ $coin->getName() }}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{number_format($coin->getPriceCurrent(), 2)}}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap
                                            {{ $coin->getPriceChange1H() >=0 ? 'text-green-800' : 'text-red-700' }}">
                                    {{number_format($coin->getPriceChange1H(), 2)}}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap
                                            {{ $coin->getPriceChange24H() >=0 ? 'text-green-800' : 'text-red-700' }}">
                                    {{number_format($coin->getPriceChange24H(), 2)}}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap
                                            {{ $coin->getPriceChange7d() >=0 ? 'text-green-800' : 'text-red-700' }}">
                                    {{number_format($coin->getPriceChange7D(), 2)}}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap ">
                                    {{number_format($coin->getMarketCap(), 2)}}
                                </td>
                            </tr>
                        </tbody>

                    </table>
                    <div>
                        <div class="flex min-w-full ml-12 mt-4">
                            <div class="max-w-sm" x-data="{open: false, buy: ''}">
                                <button x-on:click="open = !open"
                                        :class="open ? 'hover:bg-green-900 bg-green-700' : 'bg-blue-500'"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                                    BUY {{ $coin->getName() }}
                                </button>
                                <div x-show="open" x-transition x-cloak>
                                    <form action="/listings/buy?symbol={{ $coin->getSymbol() }}" method="post" name="buy">
                                        @csrf
                                        @method('PUT')
                                        <div class="mt-4">
                                            <label for="buy">Coin amount:</label>
                                            <input x-model="buy" type="number" id="buy" name="buy" placeholder="e.g. 500"><br><br>
                                            <span>
                            Buy <span x-text="buy"></span> {{ $coin->getSymbol() }} at price USD {{ $coin->getPriceCurrent() }}
                        </span>
                                        </div>
                                        <div class="my-4">
                                            <button type="submit"
                                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                                                Submit {{ $coin->getSymbol() }} buy
                                            </button>
                                        </div>
                                    </form>
                                    @error('buy')
                                    <div>{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="flex min-w-full ml-12 mt-4">

                            {{--        SELL       --}}

                            <div class="max-w-sm"  x-data="{open: false, sell: ''}">
                                <button x-on:click="open = !open"
                                        :class="open ? 'hover:bg-green-900 bg-green-700' : 'bg-red-500'"
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full">
                                    SELL {{ $coin->getName() }}
                                </button>
                                <div x-show="open" x-transition x-cloak>

                                    <form action="/listings/sell?symbol= {{ $coin->getSymbol() }}" method="post" name="sell">
                                        @csrf
                                        @method('PUT')
                                        <div class="mt-4">
                                            <label for="sell">Coin amount:</label>
                                            <input type="number" id="sell" name="sell" placeholder="e.g. 500"><br><br>
                                        </div>

                                        <div class="mt-4">
                                            Sell <span x-text="sell"></span> {{ $coin->getSymbol() }} at price USD {{ $coin->getPriceCurrent() }}
                                        </div>
                                        <div class="my-4">
                                            <button type="submit"
                                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full">
                                                Submit {{ $coin->getSymbol() }} sell
                                            </button>
                                        </div>
                                    </form>
                                    @error('sell')
                                    <div>{{$message}}</div>
                                    @enderror

                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
                </div>
            </div>
        </div>

{{--    BUY     --}}


</x-app-layout>
