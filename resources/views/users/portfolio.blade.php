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
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <div class="inline-flex">
                        <div class="mx-4">
                            Your ballance: {{ number_format($balance), 2 }} USD
                        </div>
                        <div>
                            <form action="/user/portfolio" method="post">
                                @csrf
                                @method('PATCH')
                                <label for="fiat">
                                    <input type="number" name="fiat" id="fiat" min="1" step="1" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                </label>
                                <input type="submit" name="" id="" value="Add funds" class="bg-blue-300 hover:bg-blue-700 hover:text-white font-bold py-2 px-4 rounded-full">
                            </form>
                        </div>
                    </div>
                    @unless($wallets->isEmpty())
                    <table class="min-w-full">
                        <thead class="bg-white border-b">
                        <tr>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                Coin
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                Quantity
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                Value
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                Transaction history
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                Buy/Sell
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($wallets as $wallet)

                            <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $wallet->name }}</td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{ number_format($wallet->quantity, handle($wallet->quantity)) }}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{ number_format($wallet->quantity * $wallet->price, 2) }}
                                </td>

{{--                                Transactions--}}

                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    <div class="max-w-sm" x-data="{open: false}">
                                        <button x-on:click="open = !open"
                                                :class="open ? 'hover:bg-green-900 bg-green-700' : 'bg-blue-100'"
                                                class="bg-blue-100 hover:bg-blue-700 hover:text-white font-bold py-2 px-4 rounded-full">
                                            Transactions
                                        </button>
                                        <div x-show="open" x-transition x-cloak>
                                            ndhnfgh
                                        </div>
                                    </div>

                                </td>

{{--                                Buy / Sell --}}

                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    <a href="/listings/?symbol={{ $wallet->name }}">
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
                    @else
                        <tr class="border-gray-300">
                            <td class="px-4 py-8 border-t border-b border-sky-300 text-lg">
                                <p class="text-center">No Wallets Found</p>
                            </td>
                        </tr>
                    @endunless
                </div>
            </div>
        </div>
    </div>
            </div>
        </div>
    </div>
</x-app-layout>
