<?php
/**
 * @var \App\Models\Beer[]|\Illuminate\Support\Collection $beers
 * @var integer $page
 * @var integer $per_page
 * @var bool $noMoreBeer
 */
?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="paginator">
                        <div>
                            Count {{ $beers->count() }}
                        </div>
                        <div class="buttons">
                            <label>
                                Items per page:
                                <select onchange="setPageLimit(event)" name="per_page">
                                    @foreach([10, 25, 50] as $limit)
                                        @if($limit == \Illuminate\Support\Facades\Request::query("per_page") || (!\Illuminate\Support\Facades\Request::query("per_page") && $limit === 25))
                                            <option selected>{{ $limit }}</option>
                                        @else
                                            <option>{{ $limit }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </label>
                            <button @disabled($page == 1)>
                                <a href=" {{ route('dashboard', [...\Illuminate\Support\Facades\Request::query(), 'page' => $page - 1]) }} ">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
                                    </svg>
                                </a>
                            </button>
                            <span>{{ $page }}</span>
                            <button @disabled($noMoreBeer)>
                                <a href=" {{ route('dashboard', [...\Illuminate\Support\Facades\Request::query(), 'page' => $page + 1]) }} ">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                                    </svg>
                                </a>
                            </button>
                        </div>
                    </div>
                    <table id="dashboard-table" class="table-auto">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>First Brewed</th>
                            <th>Tag</th>
                            <th>Volume</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($noMoreBeer)
                            <tr>
                                <td colspan="6">No More beer!</td>
                            </tr>
                        @endif
                        @foreach($beers as $beer)
                            <tr>
                                <td>{{ $beer->id }}</td>
                                <td>{{ $beer->name }}</td>
                                <td>{{ $beer->first_brewed?->toDateString() }}</td>
                                <td>{{ $beer->tagline }}</td>
                                <td>{{ $beer->volume['value'] }} {{ $beer->volume['unit'] }}</td>
                                <td>
                                    <button disabled="{{ $beer->image_url ? 'null' : 'disabled' }}">
                                        <a target="_blank" href="{{ $beer->image_url }}">Image</a>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
