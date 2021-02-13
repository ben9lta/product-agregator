import React from 'react';
import axios from "axios";
import {productActions} from "../../store/actions";

const productService = {
    fetchAndSave: (dispatch) => {
        axios.get('/api/products').then((response) => {
            let products = [];
            response.data.data.map(product => {
                products.push({
                    id: product.id,
                    name: product.name,
                    imageUrl: product.imageUrl,
                    price: product.price,
                    old_price: product.old_price,
                    store: product.store,
                    category: product.category
                })
            })
            dispatch(productActions.setProducts(products));
            // dispatch(paginationActions.setPagination(pagination));

        }).catch((error) => {
            console.log(error)
            dispatch(productActions.setProducts([]));
        })

    }

}

export default productService;
