<div>
    <!-- Main content -->
    <div class="mb-5 py-5 md:py-10 md:rounded-lg">

        <ul class="flex border-b px-5 sm:px-10 mb-10 tabs" x-data="{ 'activeType': '{{ $transactionType }}' }">
            <li class="-mb-px mr-1">
                <a class="bg-white inline-block py-2 px-4" :class="{'active text-semibold': activeType === 'all' }" href="/wallet/{{ $walletAddress }}/transactions/all/{{ $page }}">All</a>
            </li>
            <li class="mr-1">
                <a class="bg-white inline-block py-2 px-4" :class="{'active': activeType === 'sent' }" href="/wallet/{{ $walletAddress }}/transactions/sent/{{ $page }}">Sent</a>
            </li>
            <li class="mr-1">
                <a class="bg-white inline-block py-2 px-4" :class="{'active': activeType === 'received' }" href="/wallet/{{ $walletAddress }}/transactions/received/{{ $page }}">Received</a>
            </li>
        </ul>

        <div wire:init="fetchTxs({{ $page }})" wire:poll.10s="fetchTxs({{ $page }}, {{ true }})">

            <!-- Loading screen -->
            @if ($status === 'Loading')
                <div class="w-full">

                    <!-- Skeleton table loading effect -->
                    <livewire:table-skeleton
                        :limit="$limit"
                        :columnLabels="
                        [
                        'ID' => 'text-left',
                        'Timestamp' => 'text-left',
                        'Sender' => 'text-left',
                        'Recipient' => 'text-left',
                        'SmartBridge' => 'text-right',
                        'Amount' => 'text-right',
                        'Fee' => 'text-right'
                        ]
                        ">
                </div>
            @endif

            <div wire:loading.remove>

                <!-- Request failed -->
                @if ($status === 'Failure')

                    <livewire:error-screen :errorCode="$errorCode" :errorMessage="$errorMessage"/>

                @endif

                <!-- Successfull response -->

                @if ($status === 'Success')
                    <div>

                        <!-- Empty screen after request-->
                        @if (count($txs) === 0)

                            <livewire:list-empty-screen title="Unfortunately" description="No results were found.">

                        @else

                            <!-- Results -->
                            <table class="table table-fixed">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-left">ID</th>
                                        <th scope="col" class="text-left">Timestamp</th>
                                        <th scope="col" class="text-left">Sender</th>
                                        <th scope="col" class="text-left">Recipient</th>
                                        <th scope="col" class="text-right">SmartBridge</th>
                                        <th scope="col" class="text-right">Amount</th>
                                        <th scope="col" class="text-right">Fee</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($txs as $tx)
                                        <livewire:transaction-list-item :data="$tx" :key="$tx['id']">
                                    @endforeach
                                </tbody>

                            </table>

                            <!-- Pager -->
                            <livewire:pagination :pageCount="$pageCount" :limit="$limit" :page="$page" contextLabel="transactions">
                        @endif
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>
