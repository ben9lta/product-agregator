import React from 'react';
import {connect} from 'react-redux';
import Sidebar from "../../components/sidebar";
import {SidebarTitle} from "../../components/sidebar/SidebarTitle";

import './index.scss';
import Products from "./products";

const CatalogPage = ({categories, stores}) => {

    const handleSubmitFilteringForm = (e) => {
        e.preventDefault();
        console.log(e);
        // const data = $(form).serialize();
        // window.fetchProducts('/api/filtering', 'post', {data: data}, true);
    }

    return (
        <React.Fragment>
            <Sidebar direction={'left'}>
                <SidebarTitle title={'Каталог'} />
                <ul>
                    {categories.length > 0 && categories.map((category) => {
                        return (
                            <li key={category.id}>
                                <a href={`/catalog/category/${category.id}`} >{category.name}</a>
                            </li>
                        );
                    })}
                </ul>
            </Sidebar>

            <Products />

            <Sidebar direction={'right'}>
                <form method="POST" action="/api/filtering" className="filtering-form" onSubmit={handleSubmitFilteringForm}>

                    <div className="shop-list">
                        <SidebarTitle title={'Магазины'} />
                        <ul>
                            {stores.length > 0 && stores.map((store) => {
                                return (
                                    <li key={store.id}>
                                        <input type="checkbox" id={`store${store.id}`} name={`stores[${store.id}]`}
                                               value={store.name} />
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
                                <input type="text" id="price_from" maxLength="7" name="price_from" placeholder="0" />
                                <label htmlFor="price_to">до</label>
                                <input type="text" id="price_to" maxLength="7" name="price_to" placeholder="1000" />
                            </li>
                        </ul>
                    </div>

                    <div className="d-flex justify-content-center mt-4">
                        <input type="submit" className="submit-btn btn-active-color" value="Применить" />
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
