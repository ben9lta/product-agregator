import React from 'react';
import axios from "axios";

const productService = {
    fetch: async (params = {}, url = '/api/products') => {
        try {
            if(!url) {
                url = '/api/products';
            }

            const response = await axios.get(url , {params: params});
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
            return {isOk: true, response: products, pagination: {links: response.data.links, meta: response.data.meta}};
        } catch (e) {
            console.error(e);
            return {isOk: false, response: [], pagination: {}};
        }

    }

}

export default productService;
