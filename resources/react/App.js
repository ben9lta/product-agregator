import React from 'react';
import Header from './components/header'
import {connect, useDispatch} from 'react-redux';
import {initActions, categoryActions} from './store/actions/';
import {BrowserRouter as Router, Switch, Route, Redirect, Link} from "react-router-dom";
import Footer from "./components/footer";
import MainPage from "./pages/MainPage";
import CatalogPage from "./pages/CatalogPage";

const App = ({init}) => {
    React.useEffect(() => {
        init();
    })

    return (
        <React.Fragment>
            <Header />
            <div className="main">
                <Switch>
                    {/*<Route path="/menu" exact render={() => {*/}
                    {/*    return <MenuPage />*/}
                    {/*}}/>*/}

                    <Route path="/catalog" exact render={() => {
                        return <CatalogPage />
                    }}/>

                    <Route path="/" exact render={() => {
                        return <MainPage />
                    }}/>
                </Switch>
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
