import React from 'react';
import axios from "axios";

const cartService = {
    createCart: async (data) => {
        try {
            let user_id = null;
            if(window.user && window.user.hasOwnProperty('id')) {
                user_id = window.user.id;
            }
            const session = localStorage.getItem('token');
            return await axios.post('/api/cart', {...data, session, user_id});
        } catch (e) {
            console.error(e);
        }
    },
    addToCart: async (data) => {
        try {
            let user_id = null;
            if(window.user && window.user.hasOwnProperty('id')) {
                user_id = window.user.id;
            }
            const session = localStorage.getItem('token');
            return await axios.post('/api/cart/add', {...data, session, user_id});
        } catch (e) {
            console.error(e);
        }
    },
    deleteProduct: async (product_id) => {
        try {
            let user_id = null;
            if(window.user && window.user.hasOwnProperty('id')) {
                user_id = window.user.id;
            }
            const session = localStorage.getItem('token');
            return await axios.delete(`/api/cart/delete/${product_id}`, {data: {session, product_id, user_id}});
        } catch (e) {
            console.error(e);
        }
    },
    updateQuantity: async ({quantity, product_id}) => {
        try {
            let user_id = null;
            if(window.user && window.user.hasOwnProperty('id')) {
                user_id = window.user.id;
            }
            const session = localStorage.getItem('token');
            return await axios.put(`/api/cart/quantity/${quantity}/product/${product_id}`, {
                session, quantity: quantity, product_id: product_id, user_id
            });
        } catch (e) {
            console.error(e);
        }
    },
    getCart: () => {
        let user_id = null;
        if(window.user && window.user.hasOwnProperty('id')) {
            user_id = window.user.id;
        }
        const session = localStorage.getItem('token');
        return axios.post('/api/cart/get', {session, user_id})
    },

}

export default cartService;
