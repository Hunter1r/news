@extends('layouts.adminMain');

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Categories</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a class="btn btn-success" href="{{ route('admin.categories.create') }}" role="button">Add</a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $item)
                    <tr>
                        <td>{{ $item->category_id }}</td>
                        <td>{{ $item->category_name }}</td>
                        <td>
                            <div class="navbar justify-content-start">
                                <a class="me-3"
                                    href="{{ route('admin.categories.edit', ['category' => $item->category_id]) }}">
                                    <svg class="bi bi-pencil" width="16" height="16">
                                        <use xlink:href="#pencil" />
                                    </svg>
                                </a>
                                <a href="javascript:;" class="remove" data-id="{{ $item->category_id }}">
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
    {{$categories->links()}}
    <x-modal-ok-cancel></x-modal-ok-cancel>
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
            
            let delItem = undefined;

            trashLinks.forEach(element => {
                element.addEventListener('click', (event) => {
                    modalTitle.textContent = "Deleting Category"
                    modalDescription.textContent = "Are you shure to delete Category with id=" + element
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
                            myModal.hide();
                            location.reload();
                        })
                    });
                    delItem = undefined;
                }
            })
        })

        function deleteItem(id) {
            return fetch('/admin/categories/' + id, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
            })
        }
</script>
    
@endpush