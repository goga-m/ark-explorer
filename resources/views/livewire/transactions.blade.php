<div>

    <!-- Network information -->
    <livewire:network-info wire:init="fetchInfo">

    <!-- Content top  section -->
    <div class="flex justify-between flex-wrap px-5 sm:px-10 xl:px-0">

        <!-- Page title -->
        <h1 class="text-2xl md:text-3xl mb-5 md:mb-6 text-theme-text-primary sm:mr-5 font-bold">
            Transactions
        </h1>
        <div class="sm:flex items-center mb-6">
            <livewire:network-switcher>
        </div>
    </div>

    <!-- Main content -->
    <div class="main-content mb-5 py-5 md:py-10 md:rounded-lg">
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
