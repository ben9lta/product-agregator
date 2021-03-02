import React from 'react';
import {connect, useDispatch} from 'react-redux';
import Sidebar from "../../components/sidebar";
import {SidebarTitle} from "../../components/sidebar/SidebarTitle";
import './index.scss';
import Products from "./products";
import productService from "../../api/services/productService";
import {categoryActions} from "../../store/actions";
import {paginationActions} from "../../store/actions";
import Toast from "../../components/cart/toast";

const CatalogPage = ({categories, stores}) => {
    const dispatch = useDispatch();
    const [products, setProducts] = React.useState([]);
    const [category, setCategory] = React.useState({});
    const initialFilters = {
        price_from: 0,
        price_to: 10000,
        category: undefined,
    }
    const [filterForm, setFilterForm] = React.useState(initialFilters);
    const [isLoading, setIsLoading] = React.useState('false');
    const checkboxRef = React.useRef([]);

    React.useEffect(() => {
        fetchProducts();
    }, []);

    const handleSubmitFilterForm = (e) => {
        setIsLoading(true);
        e.preventDefault();
        fetchProducts();
    }

    const resetFilter = () => {
        setIsLoading(true);
        setFilterForm(initialFilters);
        checkboxRef.current.map(input => input.checked = false);
        fetchProducts(initialFilters);
        dispatch(categoryActions.setCurrentCategory('Продукты'));
    }

    const handleCategory = (e) => {
        setIsLoading(true);
        setFilterForm(initialFilters);
        const category = {id: +e.target.dataset.id, name: e.target.textContent};
        setCategory(category);
        const currentCategory = category.id ? category.name : 'Продукты';
        dispatch(categoryActions.setCurrentCategory(currentCategory));
        fetchProducts({category: category.id});
    }

    const fetchProducts = (params = {}, url = null, refresh = true) => {
        if(Object.keys(params).length === 0) {
            params = {...filterForm, category: category.id}
        }

        productService.fetch(params, url).then(data => {
            dispatch(paginationActions.setPagination(data.pagination));
            if (refresh) {
                setProducts(data.response);
            } else {
                setProducts([...products, ...data.response]);
            }

        }).finally(() => {
            setIsLoading(false);
        });
    }

    const handleStores = (e) => {
        setFilterForm({...filterForm, [e.target.name]: e.target.checked ? e.target.value : null});
    }

    const handlePrice = (e) => {
        setFilterForm({...filterForm, [e.target.name]: e.target.value});
    }

    const handlePagination = (e) => {
        e.preventDefault();
        const url = e.currentTarget.href;
        fetchProducts({}, url);
    }

    return (
        <React.Fragment>
            <Toast />
            <Sidebar direction={'left'}>
                <SidebarTitle title={'Каталог'} />
                <ul>
                    <li>
                        <a href="#" onClick={isLoading ? null : handleCategory} data-id={null}>Все</a>
                    </li>
                    {categories.length > 0 && categories.map((category) => {
                        return (
                            <li key={category.id}>
                                <a href="#" onClick={isLoading ? null : handleCategory} data-id={category.id}>{category.name}</a>
                            </li>
                        );
                    })}
                </ul>
            </Sidebar>

            <Products products={products}
                      isLoading={isLoading}
                      title={'Продукты'}
                      handlePagination={handlePagination}
                      fetchProducts={fetchProducts}/>

            <Sidebar direction={'right'}>
                <form method="get" className="filtering-form" onSubmit={isLoading ? null : handleSubmitFilterForm}>

                    <div className="shop-list">
                        <SidebarTitle title={'Магазины'} />
                        <ul>
                            {stores.length > 0 && stores.map((store) => {
                                return (
                                    <li key={store.id}>
                                        <input type="checkbox" id={`store${store.id}`} name={`stores[${store.id}]`}
                                            ref={(e) => checkboxRef.current[store.id] = e}
                                            defaultChecked={filterForm[`stores[${store.id}]`]}
                                            value={store.id} onChange={handleStores}
                                        />
                                        <label htmlFor={`store${store.id}`}>{store.name}</label>
                                    </li>
                                );
                            })}
                        </ul>
                    </div>

                    <div className="filter-list">
                        <SidebarTitle title={'Цена'} />
                        <ul className="filter-price">
                            <li>
                                <label htmlFor="price_from">от</label>
                                <input type="text" id="price_from" value={filterForm.price_from}
                                       onChange={handlePrice}
                                       maxLength="7" name="price_from" placeholder="0" />
                                <label htmlFor="price_to">до</label>
                                <input type="text" id="price_to" value={filterForm.price_to}
                                       onChange={handlePrice}
                                       maxLength="7" name="price_to" placeholder="1000" />
                            </li>
                        </ul>
                    </div>

                    <div className="d-flex justify-content-center flex-column align-items-center mt-4">
                        <input type="submit" className="submit-btn btn-active-color mb-2" value="Применить" />
                        <input type="button" className="submit-btn btn-active-color" value="Очистить" onClick={isLoading ? null : resetFilter} />
                    </div>
                </form>
            </Sidebar>
        </React.Fragment>
    );
}

const mapStateToProps = (state) => {
    return {
        categories: state.categoryReducer.categories,
        stores: state.storeReducer.stores,
    }
}

export default connect(mapStateToProps, {})(CatalogPage);
