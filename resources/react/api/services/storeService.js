import React from 'react';
import axios from "axios";
import {storeActions} from "../../store/actions";

const storeService = {
    fetchAndSave: (dispatch) => {
        axios.get('/api/stores').then((response) => {
            let stores = [];
            response.data.data.map(store => {
                stores.push({
                    id: store.id,
                    name: store.name,
                })
            })
            dispatch(storeActions.setStores(stores));

        }).catch((error) => {
            console.log(error)
            dispatch(storeActions.setStores([]));
        })

    }

}

export default storeService;
