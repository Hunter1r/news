@extends('layouts.adminMain');

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">News</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a class="btn btn-success" href="{{ route('admin.news.create') }}" role="button">Add</a>
        </div>
    </div>
    @include('message')

    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Title</th>
                    <th scope="col">Category</th>
                    <th scope="col">Description</th>
                    <th scope="col">Image</th>
                    <th scope="col">Author</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Active</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($news as $item)
                    <tr>
                        <td>{{ $item->date }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->category_name }}</td>
                        <td>{{ $item->description }}</td>
                        <td>{{ $item->image }}</td>
                        <td>{{ $item->author }}</td>
                        <td>{{ $item->slug }}</td>
                        <td>{{ $item->active }}</td>
                        <td>
                            <div class="navbar">
                                <a href="{{ route('admin.news.edit', ['news' => $item->news_id]) }}">
                                    <svg class="bi bi-pencil" width="16" height="16">
                                        <use xlink:href="#pencil" />
                                    </svg>
                                </a>
                                <a href="javascript:;" class="remove" data-id="{{ $item->news_id }}">
                                    <svg class="bi bi-trash3" width="16" height="16">
                                        <use xlink:href="#trash" />
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{$news->links()}}

    <x-modal-ok-cancel></x-modal-ok-cancel>
    <x-toast></x-toast>
@endsection


@push('scripts')
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', (event) => {
            const trashLinks = document.querySelectorAll('.remove');
            const modal = document.getElementById('modalOkCancel');
            const modalTitle = document.getElementById('modalTitle');
            const modalDescription = modal.querySelector('.description');
            const okBtn = modal.querySelector('.btn-primary');
            const btns = modal.querySelectorAll('.btn');
            const myModal = new bootstrap.Modal(modal);
            const toast = document.getElementById('liveToast');
            const toastTitle = toast.querySelector('.me-auto');
            const toastTime = toast.querySelector('.time');
            const toastDescription = toast.querySelector('.toast-body');
            const toastObj = new bootstrap.Toast(toast, {
                'delay': 5000
            });
            let delItem = undefined;


            trashLinks.forEach(element => {
                element.addEventListener('click', (event) => {
                    modalTitle.textContent = "Deleting News"
                    modalDescription.textContent = "Are you shure to delete News with id=" + element
                        .dataset.id + " ?";
                    delItem = element.dataset.id;
                    myModal.show();
                })

            });

            modal.addEventListener('hidden.bs.modal', function(event) {
                btns.forEach((item) => {
                    item.removeAttribute('disabled');
                });
                okBtn.innerHTML = "Ok";
            })

            modal.addEventListener('show.bs.modal', function(event) {})
            okBtn.addEventListener('click', () => {
                if (delItem) {
                    btns.forEach((item) => {
                        item.setAttribute('disabled', 'disabled');
                    });
                    okBtn.innerHTML =
                        "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>Deleting...";
                    deleteItem(delItem).then((response) => {
                        response.json().then((res) => {
                            toastTitle.textContent = res.author;
                            toastTime.textContent = new Date().toLocaleString('en-US');
                            toastDescription.textContent = 'News with id=' + res.id +
                                ' and title ' + res.title + 'is deleted';
                            myModal.hide();
                            // location.reload();
                            // toastObj.show();  
                        })
                    });
                    delItem = undefined;
                }
            })
        })

        function deleteItem(id) {
            return fetch('/admin/news/' + id, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
            })
        }
    </script>
@endpush