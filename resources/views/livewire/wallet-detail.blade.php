<div>
    <!-- Network information -->
    <livewire:network-info wire:init="fetchInfo">

    <!-- Page title -->
    <div class="flex justify-between flex-wrap px-5 sm:px-10 xl:px-0">
        <h1 class="text-2xl md:text-3xl mb-5 md:mb-6 text-theme-text-primary sm:mr-5 font-bold">
            Wallet details
        </h1>
    </div>

    <!-- Content top section  (Transaction info) -->
    <section class="mb-5 bg-theme-feature-background xl:rounded-lg flex-col items-center px-2 sm:px-10 py-8 text-white">
        <div><h2 class="text-lg font-bold">Address</h2></div>
        <div class="truncate text-xl">{{ $walletAddress }}</div>
    </section>

    <!-- Main content -->
    <div class="main-content mb-5 py-5 md:py-10 md:rounded-lg" wire:init="fetchWallet">

        <!-- Request failed -->
        @if ($status === 'Failure')

            <livewire:error-screen :errorCode="$errorCode" :errorMessage="$errorMessage"/>

        @else
            <!-- Main content -->
            <!-- Showing skeleton sections per field -->
            <div class="px-5 sm:px-10">

                @if (isset($formatted['username']))
                    <div class="detail-row">
                        <div class="mr-4">User name</div>
                        <div wire:loading class="w-16"><div class="skeleton"></div></div>
                        <div class="truncate w-2/5 text-right" wire:loading.remove> {{ $formatted['username']}}</div>
                    </div>
                @endif

                @if (isset($formatted['status']))
                    <div class="detail-row">
                        <div class="mr-4">Status</div>
                        <div wire:loading class="w-16"><div class="skeleton"></div></div>
                        <div class="truncate w-2/5 text-right" wire:loading.remove> {{ $formatted['status']}}</div>
                    </div>
                @endif

                <div class="detail-row">
                    <div class="mr-4">Public Key</div>
                    <div wire:loading class="w-16"><div class="skeleton"></div></div>
                    <div class="truncate w-2/5 text-right" wire:loading.remove><a class="link" href="{{ $formatted['path'] }}" title="{{ $formatted['publicKey']}}">{{ $formatted['publicKey'] }}</a></div>
                </div>

                <div class="detail-row">
                    <div class="mr-4">Balance</div>
                    <div wire:loading class="w-40"><div class="skeleton"></div></div>
                    <div wire:loading.remove>{{ $formatted['balance'] }} Ѧ</div>
                </div>

                @if (isset($formatted['rank']))
                    <div class="detail-row">
                        <div class="mr-4">Rank</div>
                        <div wire:loading class="w-16"><div class="skeleton"></div></div>
                        <div class="truncate w-2/5 text-right" wire:loading.remove> {{ $formatted['rank']}}</div>
                    </div>
                @endif

                @if (isset($formatted['forgedRewards']))
                    <div class="detail-row">
                        <div class="mr-4">Forged Rewards</div>
                        <div wire:loading class="w-16"><div class="skeleton"></div></div>
                        <div class="truncate w-2/5 text-right" wire:loading.remove> {{ $formatted['forgedRewards']}} Ѧ</div>
                    </div>
                @endif

                @if (isset($formatted['forgedFees']))
                    <div class="detail-row">
                        <div class="mr-4">Forged Fees</div>
                        <div wire:loading class="w-16"><div class="skeleton"></div></div>
                        <div class="truncate w-2/5 text-right" wire:loading.remove> {{ $formatted['forgedFees']}} Ѧ</div>
                    </div>
                @endif

                @if (isset($formatted['producedBlocks']))
                    <div class="detail-row">
                        <div class="mr-4">Forged blocks</div>
                        <div wire:loading class="w-16"><div class="skeleton"></div></div>
                        <div class="truncate w-2/5 text-right" wire:loading.remove> {{ $formatted['producedBlocks']}} </div>
                    </div>
                @endif

                @if (isset($formatted['voteBalance']))
                    <div class="detail-row">
                        <div class="mr-4">Vote balance</div>
                        <div wire:loading class="w-16"><div class="skeleton"></div></div>
                        <div class="truncate w-2/5 text-right" wire:loading.remove> {{ $formatted['voteBalance']}} Ѧ</div>
                    </div>
                @endif
                @if (isset($formatted['vote']))
                    <div class="detail-row">
                        <div class="mr-4">Voting for</div>
                        <div class="truncate">
                            <livewire:wallet-name :publicKey="$formatted['vote']"/>
                        </div>
                    </div>
                @endif

            </div>

            <!-- Wallet transactions -->
            <div class="mt-10 px-5 sm:px-10"><h3 class="text-2xl font-bold">Transactions</h2></div>

            <livewire:wallet-transactions :page="$page" :walletAddress="$walletAddress" :transactionType="$transactionType"/>
        @endif

    </div>
</div>
