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
                    @unless($transactions->isEmpty())
                        <table class="min-w-full">
                            <thead class="bg-blue-400 border-b">
                            <tr>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Coin
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Status
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Quantity
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Price, USD
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Value, USD
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Transaction history
                                </th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($transactions as $transaction)

                                <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $transaction->name }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        {{ $transaction->status }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        {{ number_format($transaction->quantity, handle($transaction->quantity)) }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        {{ number_format($transaction->price, handle($transaction->price)) }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        {{ number_format($transaction->price * $transaction->quantity, 2) }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        {{ $transaction->created_at }}
                                    </td>

                                    {{--                                Buy / Sell --}}


                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <tr class="border-gray-300">
                            <td class="px-4 py-8 border-t border-b border-sky-300 text-lg">
                                <p class="text-center">No Transactions Found</p>
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
