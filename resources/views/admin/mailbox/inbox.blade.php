@extends('layouts.admin-header')

@section('features')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <error-banner error="{{$error}}"></error-banner>
        @endforeach
    @endif

    @if(isset($emails) && count($emails)>0)
        <div class="mr-4 xl:mr-6 mt-8 xl:mt-10 mb-8">
            <div class="-my-2 sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="max-w-7xl shadow border-b border-gray-200 sm:rounded">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-headings font-bold text-gray-500 uppercase tracking-wider">
                                    Recipient
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-headings font-bold text-gray-500 uppercase tracking-wider">
                                    Message
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-headings font-bold text-gray-500 uppercase tracking-wider">
                                    Date
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($emails as $email)
                                <tr>
                                    <td>

                                    </td>
                                    <td class="px-6 py-4 max-w-xs whitespace-nowrap">
                                        <div class="text-sm truncate">
                                            <a href="{{'/admin/mailbox/view/'.$email->id}}" class="text-gray-500 hover:underline font-medium hover:text-accent-800">
                                                {{$email->message}}
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex items-center">
                                            @if((\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $email->created_at)->diffInDays()) < 1 )
                                            <div class="text-sm font-medium text-gray-900">
                                                {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $email->created_at)->diffForHumans()}}
                                            </div>
                                            @else
                                            <div class="text-sm font-medium text-gray-900">
                                                {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $email->created_at)->toDayDateTimeString()}}
                                            </div>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="px-4 py-2">{{ $emails->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="text-gray-600 font-medium text-xl my-12">
            No emails received yet  :-}
        </div>
    @endif

@endsection