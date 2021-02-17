import React from 'react';
import axios from "axios";

const storeService = {
    fetch: async () => {
        try {
            const response = await axios.get('/api/stores');
            let stores = [];
            response.data.data.map(store => {
                stores.push({
                    id: store.id,
                    name: store.name,
                })
            })
            return stores;
        } catch (e) {
            console.error(e);
            return [];
        }
    }

}

export default storeService;
