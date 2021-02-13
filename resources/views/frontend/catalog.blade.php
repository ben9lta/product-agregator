<script>
    window.fetchProducts = (apiRequest = '', method = 'get', data = {}, filtering = false) => {
        const productItems = $('.productReducer .items .product__item');
        if(filtering && productItems) {
            productItems.remove();
        }

        let productsTitle = $('.products__title').text() || undefined;
        if(!apiRequest) {
            const page = window.location.search;
            apiRequest = `/api/productReducer${page}`;
            productsTitle = 'Продукты';
        }

        $.ajax({url: apiRequest, type: method, data: data, success: (response) => {
            renderProducts(response, productsTitle, filtering);
        }});

    }

    const renderProducts = (data, productsTitle, filtering) => {
        if(!productsTitle) {
            productsTitle = data.data[0].category.name;
        }
        document.querySelector('.products__title').textContent = productsTitle;
        const productsBlock = $('.productReducer .items')[0];

        data.data.map((product) => {
            productsBlock.innerHTML += (renderProduct(product));
        });

        if(data.data.length > 0 && data.meta.last_page > 1) {
            let productsFooter = document.querySelector('.productReducer-footer');
            if(!productsFooter) {
                productsFooter = document.createElement('div');
                productsFooter.className = 'products-footer';
            } else {
                productsFooter.remove();
            }

            productsFooter = document.createElement('div');
            productsFooter.className = 'products-footer';

            if (data.meta.last_page - data.meta.current_page > 0) {
                const button = createButtonShowMore(data);
                productsFooter.appendChild(button);
            }

            productsFooter.appendChild(renderPagination(data));
            productsBlock.insertAdjacentElement('afterend', productsFooter);
        }
    }

    const createButtonShowMore = (data) => {
        const pageNumber = data.meta.last_page - data.meta.current_page > 0 ? data.meta.current_page + 1 : '';
        const button = document.createElement('button');
        button.className = 'show-more btn-active-color';
        button.textContent = 'Показать еще';
        console.log(data);
        button.dataset.next = data.links.next;
        button.dataset.pageNumber = pageNumber;
        button.onclick = loadMore;
        return button;
    }

    const loadMore = (e) => {
        e.preventDefault();
        const page = e.target.dataset.pageNumber;
        history.pushState(null, null, `?page=${page}`)
        return fetchProducts(e.target.dataset.next);
    }

    const getPageFromUrl = (url = '') => {
        if(!url) {
            url = window.location.search;
            const urlParams = new URLSearchParams(url);
            return urlParams.get('page') ? urlParams.get('page') : 1;
        } else {
            const paramIndex = url.search(/page=/);
            return paramIndex !== -1 ? url.slice(paramIndex + 5) : 1;
        }
    }

    const renderPagination = (data) => {
        let pagination = document.querySelector('.pagination');
        if(!pagination) {
            pagination = document.createElement('ul');
            pagination.className = 'pagination';
        } else {
            pagination.remove();
        }
        const classLeftPagination = data.meta.current_page === 1 ? 'page-link disabled' : 'page-link';
        const classRightPagination = data.meta.current_page === data.meta.last_page ? 'page-link disabled' : 'page-link';

        const firstPage = getPageFromUrl(data.links.first);
        const prevPage = getPageFromUrl(data.links.prev);
        const nextPage = getPageFromUrl(data.links.next);
        const lastPage = getPageFromUrl(data.links.last);
        pagination.innerHTML = `
            <li class="page-item"><a class="${classLeftPagination} first-link" href="?page=${firstPage}"><img src="{{'/icons/two-dir.svg'}}" /></a></li>
            <li class="page-item"><a class="${classLeftPagination} prev-link" href="?page=${prevPage}"><img src="{{'/icons/one-dir.svg'}}" /></a></li>
            ${renderPaginationPages(data.meta)}
            <li class="page-item"><a class="${classRightPagination} next-link" href="?page=${nextPage}"><img src="{{'/icons/one-dir.svg'}}" /></a></li>
            <li class="page-item"><a class="${classRightPagination} last-link" href="?page=${lastPage}"><img src="{{'/icons/two-dir.svg'}}" /></a></li>
        `;
        return pagination;
    }

    const renderPaginationPages = (meta) => {
        let pages = '';
        for(let i = 1; i <= meta.last_page; i++) {
            const className = meta.current_page === i ? 'page-link active' : 'page-link';
            pages += `<li class="page-item"><a class="${className}" data-page="${i}" href="/catalog?page=${i}">${i}</a></li>`
        }

        return pages;
    }

    const renderProduct = (product) => {
        return `
        <div class="product__item">
            <img src="${product.imageUrl}" alt="${product.name}" class="product__img"/>
            <div class="wrapper">
                <div class="product-info">
                    <p class="product__title">${product.name}</p>
                    <span class="product__store">${product.store.name}</span>
                </div>
                <div class="product__footer">
                    <div class="price-info">
                        <span class="old-price">${product.old_price ? product.old_price + 'руб.' : ''}</span>
                        <span class="price">${product.price} руб.</span>
                    </div>
                    <div class="btn-wrapper">
                        <div class="btn-cart">
                            <span>+</span>
                            <svg width="22" height="18" viewBox="0 0 22 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.875 1.33499H4.15625L6.4375 11.9993H18.1696L20.125 4.6676H6.4375" stroke="#F0F0F0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <ellipse cx="9.04469" cy="14.9987" rx="1.62946" ry="1.6663" stroke="#F0F0F0" stroke-width="2"/>
                                <ellipse cx="15.5625" cy="14.9987" rx="1.62946" ry="1.6663" stroke="#F0F0F0" stroke-width="2"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>`
    }

    let apiRequest;
    const category = {{isset($category) ? $category : 'undefined'}};
    if(category) {
        apiRequest = `/api/categories/${category}/productReducer`;
    }

    document.addEventListener('DOMContentLoaded', () => fetchProducts(apiRequest));
</script>


@extends('layouts.index')

@section('content')
    @include('layouts.sidebar.left')
    <div class="products">
        <h2 class="products__title"></h2>
        <div class="items">

        </div>
    </div>
    @include('layouts.sidebar.right')
@endsection
