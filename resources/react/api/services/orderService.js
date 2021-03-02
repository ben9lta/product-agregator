import React from 'react';
import axios from "axios";

const orderService = {
    createOrder: async (data) => {
        try {
            let user_id = null;
            if(window.user && window.user.hasOwnProperty('id')) {
                user_id = window.user.id;
            }
            const session = localStorage.getItem('token');
            return await axios.post('/api/order', {...data, session, user_id});
        } catch (e) {
            console.error(e);
        }
    },
}

export default orderService;
