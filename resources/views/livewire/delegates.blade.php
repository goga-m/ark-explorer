<div>

    <!-- Network information -->
    <livewire:network-info wire:init="fetchInfo">

    <!-- Content top section -->
    <div class="flex justify-between flex-wrap px-5 sm:px-10 xl:px-0">

        <!-- Page title -->
        <h1 class="text-2xl md:text-3xl mb-5 md:mb-6 text-theme-text-primary sm:mr-5 font-bold">
            Delegates
        </h1>
        <div class="sm:flex items-center mb-6">
            <livewire:network-switcher>
        </div>
    </div>

    <!-- Main content -->
    <div class="main-content mb-5 py-5 md:py-10 md:rounded-lg">
        <div wire:init="fetchPage({{ $page }})" wire:poll.10s="fetchPage({{ $page }}, {{ true }})">

            <!-- Loading screen -->
            @if ($status === 'Loading')
                <div class="w-full">

                    <!-- Skeleton table loading effect -->
                    <livewire:table-skeleton
                        :limit="$limit"
                        :columnLabels="
                        [
                        'Rank' => 'text-left',
                        'Username' => 'text-left',
                        'Forged blocks' => 'text-left',
                        'Last forged' => 'text-left',
                        'Status' => 'text-left',
                        'Votes' => 'text-right',
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
                    <div class="">

                        <!-- Empty screen after request-->
                        @if (count($data) === 0)

                            <livewire:list-empty-screen title="Unfortunately" description="No results were found.">

                        @else

                            <!-- Results -->
                            <table class="table table-fixed">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-left">Rank</th>
                                        <th scope="col" class="text-left">Username</th>
                                        <th scope="col" class="text-left">Forged blocks</th>
                                        <th scope="col" class="text-left">Last forged</th>
                                        <th scope="col" class="text-left">Status</th>
                                        <th scope="col" class="text-right">Votes</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($data as $delegate)
                                        <livewire:delegate-list-item :data="$delegate" :key="$delegate['address']">
                                    @endforeach
                                </tbody>

                            </table>

                            <!-- Pager -->
                            <livewire:pagination :pageCount="$pageCount" :limit="$limit" :page="$page" contextLabel="Delegates" :key="$page">
                        @endif
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>
