import React from 'react';
import ReactDOM from 'react-dom';
import {BrowserRouter as Router} from "react-router-dom";
import {Provider} from "react-redux";
import App from './App';
import store from './store/store'

if (localStorage.getItem('token') === null) {
    localStorage.setItem('token', Math.random())
}

ReactDOM.render(
    <Provider store={store}>
        <Router><App /></Router>
    </Provider>, document.getElementById('root')

);

