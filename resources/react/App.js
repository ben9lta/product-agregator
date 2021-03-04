import React from 'react';
import Header from './components/header'
import {connect, useDispatch} from 'react-redux';
import {initActions, categoryActions} from './store/actions/';
import {BrowserRouter as Router, Switch, Route, Redirect, Link} from "react-router-dom";
import Footer from "./components/footer";
import MainPage from "./pages/MainPage";
import CatalogPage from "./pages/CatalogPage";
import SuccessOrder from "./pages/OrderPage/success";

const App = ({init}) => {
    React.useEffect(() => {
        init();
    })

    return (
        <React.Fragment>
            <Header />
            <div className="main">
                <Router>
                    <Switch>
                        <Route path="/catalog" component={CatalogPage} />
                        <Route path="/order/success" exact component={() => {
                            return localStorage.getItem('orderSuccess')
                            ? <SuccessOrder />
                            : <Redirect to={'/'} />
                        }} />
                        <Route path="/" exact component={MainPage} />
                        <Route component={MainPage} />
                    </Switch>
                </Router>
            </div>
            <Footer />
        </React.Fragment>
    );
}

const mapStateToProps = (state) => {
    return {

    }
}

export default connect(mapStateToProps, {...initActions})(App);
