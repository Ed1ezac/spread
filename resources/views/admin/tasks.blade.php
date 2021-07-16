@extends('layouts.admin-header')

@section('features')
    <div class="mb-8">
        @if(isset($history) && count($history)>0)
        <div class="mr-4 xl:mr-6 mt-8 xl:mt-10 mb-8">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="max-w-7xl shadow overflow-hidden border-b border-gray-200 sm:rounded">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-headings font-bold text-gray-500 uppercase tracking-wider">
                                Task (sms)
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-headings font-bold text-gray-500 uppercase tracking-wider">
                                Status
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-headings font-bold text-gray-500 uppercase tracking-wider">
                                Progress
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-headings font-bold text-gray-500 uppercase tracking-wider">
                                Start Time
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-headings font-bold text-gray-500 uppercase tracking-wider">
                                Total Time
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($history as $record)
                            <tr>
                                <td class="px-6 py-4 max-w-xs whitespace-nowrap">
                                    <div class="text-sm truncate">
                                        <a href="{{'/admin/rollout-tasks/view/task/'.$record->id}}" class="text-gray-500 hover:underline font-medium hover:text-accent-800">
                                            {{ (\App\Models\Sms::find($record->trackable_id))->message }}
                                        </a>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    @if($record->status == 'failed')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-200 text-red-800">
                                        {{$record->status}}
                                    </span>
                                    @elseif($record->status == 'finished')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        {{$record->status}}
                                    </span>
                                    @elseif($record->status == 'executing' || $record->status == 'retrying')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-primary-200 text-primary-800">
                                        {{$record->status}}
                                    </span>
                                    @elseif($record->status == 'queued')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-primary-200 text-primary-800">
                                        {{$record->status}}
                                    </span>
                                    @endif
                                </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-gray-800">{{$record->progress_now.' \\ '.$record->progress_max}}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if(isset($record->started_at) && $record->started_at->diffInDays() < 1 )
                                    <div class="text-sm text-gray-500">
                                        {{ $record->started_at->diffForHumans() }}
                                    </div>
                                    @elseif(isset($record->started_at))
                                    <div class="text-sm text-gray-500">
                                        {{ $record->started_at->toDayDateTimeString() }}
                                    </div>
                                    @else
                                    <div class="text-sm text-gray-500">
                                        --:--
                                    </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">
                                    {{ ($record->finished_at == null || $record->started_at == null) ? 'pending..' : 
                                        $record->started_at->diffForHumans($record->finished_at, true) }}
                                    </div>                                
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="px-4 py-2">{{ $history->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

@endsection