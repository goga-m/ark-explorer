<div>

    <!-- Network information -->
    <livewire:network-info wire:init="fetchInfo">

    <!-- Page title -->
    <div class="flex justify-between flex-wrap px-5 sm:px-10 xl:px-0">
        <h1 class="text-2xl md:text-3xl mb-5 md:mb-6 text-theme-text-primary sm:mr-5 font-bold">
            Transaction details
        </h1>
    </div>

    <!-- Content top section  (Transaction info) -->
    <section class="mb-5 bg-theme-feature-background xl:rounded-lg flex-col items-center px-2 sm:px-10 py-8 text-white">
        <div><h2 class="text-lg font-bold">Transaction ID</h2></div>
        <div class="truncate text-xl">{{ $txId }}</div>
    </section>

    <!-- Main content -->
    <div class="main-content mb-5 py-5 md:py-10 md:rounded-lg" wire:init="fetchTx">

        <!-- Request failed -->
        @if ($status === 'Failure')

            <livewire:error-screen :errorCode="$errorCode" :errorMessage="$errorMessage"/>

        @else
            <!-- Main content -->
            <!-- Showing skeleton sections on value -->
            <div class="px-5 sm:px-10">

                <div class="detail-row">
                    <div class="mr-4">Sender</div>
                    <div wire:loading class="w-16"><div class="skeleton"></div></div>
                    <div class="truncate w-2/5 text-right" wire:loading.remove><a class="link" href="{{ $tx['senderPath'] }}" title="{{ $tx['senderAddress']}}">{{ $tx['senderAddress'] }}</a></div>
                </div>

                <div class="detail-row">
                    <div class="mr-4">Recipient</div>
                    <div wire:loading class="w-16"><div class="skeleton"></div></div>
                    <div class="truncate w-2/5 text-right" wire:loading.remove><a class="link" href="{{ $tx['recipientPath'] }}" title="{{ $tx['recipientAddress']}}">{{ $tx['recipientAddress'] }}</a></div>
                </div>

                <div class="detail-row">
                    <div class="mr-4">Confirmations</div>
                    <div wire:loading class="w-12"><div class="skeleton"></div></div>
                    <div wire:loading.remove> {{ $tx['confirmations'] }} </div>
                </div>

                <div class="detail-row">
                    <div class="mr-4">Amount</div>
                    <div wire:loading class="w-16"><div class="skeleton"></div></div>
                    <div wire:loading.remove> {{ $tx['amount'] }} Ѧ </div>
                </div>

                <div class="detail-row">
                    <div class="mr-4">Fee</div>
                    <div wire:loading class="w-16"><div class="skeleton"></div></div>
                    <div wire:loading.remove> {{ $tx['fee'] }} Ѧ </div>
                </div>

                <div class="detail-row">
                    <div class="mr-4">Timestamp</div>
                    <div wire:loading class="w-16"><div class="skeleton"></div></div>
                    <div wire:loading.remove> {{ $tx['timestamp'] }}</div>
                </div>

                <div class="detail-row">
                    <div class="mr-4">SmartBridge</div>
                    <div wire:loading class="w-40"><div class="skeleton"></div></div>
                    <div class="truncate w-2/5 text-right" wire:loading.remove><div>{{ $tx['vendorField'] }}</div></div>
                </div>

                <div class="detail-row">
                    <div class="mr-4">Block ID</div>
                    <div wire:loading class="w-16"><div class="skeleton"></div></div>
                    <div class="truncate w-2/5 text-right" wire:loading.remove><a class="link" href="{{ $tx['blockPath'] }}">{{ $tx['blockId'] }}</a></div>
                </div>
            </div>
        @endif

        @if(isset($tx['payments']) && count($tx['payments']) > 0)

            <h3 class="text-lg font-bold px-5 sm:px-10 mt-10">Payments</h2>

            <!-- Results -->
            <table class="table table-fixed">
                <thead>
                    <tr>
                        <th scope="col" class="text-left">Recipients</th>
                        <th scope="col" class="text-right">Amount</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($tx['payments'] as $payment)
                        <tr>
                            <td scope="row" data-label="Recipients">
                                <div class="truncate"><a class="link" href="/wallet/{{ $payment['recipientId'] }}" title="{{{ $payment['recipientId'] }}}">{{{ $payment['recipientId'] }}}</a></div>
                            </td>

                            <td scope="row" data-label="Amount" class="text-right"> <div class="truncate"> {{  $payment['amount'] }} Ѧ </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>

            </table>
        @endif
    </div>
</div>
{{-- If your happiness depends on money, you will never be happy with yourself. --}}
</div>
