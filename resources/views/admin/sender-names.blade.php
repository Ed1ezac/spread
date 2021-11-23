@extends('layouts.admin-header')

@section('features')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <error-banner error="{{$error}}"></error-banner>
        @endforeach
    @endif

    @if(isset($senderNames) && count($senderNames)>0)
    <div class="m-2 mb-8 text-sm">
        <div class="mr-4 xl:mr-6 mt-8 xl:mt-10">
            <div class="-my-2 sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="max-w-7xl shadow border-b border-gray-200 sm:rounded">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-headings font-bold text-gray-500 uppercase tracking-wider">
                                    Sender Name 
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-headings font-bold text-gray-500 uppercase tracking-wider">
                                    Company
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-headings font-bold text-gray-500 uppercase tracking-wider">
                                    Status
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-headings font-bold text-gray-500 uppercase tracking-wider">
                                    Contact
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($senderNames as $name )
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <a href="{{'/admin/sender-names/'.$name->id.'/details'}}" class="font-semibold text-gray-500 hover:underline hover:text-accent-800">
                                                {{ $name->sender_name}}
                                            </a>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center text-gray-500">
                                        {{ $name->company_name }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            @if($name->status == 'pending')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-200 text-gray-700">
                                                {{$name->status}}
                                            </span>
                                            @elseif($name->status == 'approved')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                {{$name->status}}
                                            </span>
                                            @elseif($name->status == 'rejected')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-200 text-red-800">
                                                {{$name->status}}
                                            </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">
                                            {{ $name->company_contact_number }}
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="px-4 py-2">{{ $senderNames->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else


    @endif

@endsection