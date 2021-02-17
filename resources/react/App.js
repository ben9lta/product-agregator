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
                <Router>
                    <Switch>
                        <Route path="/catalog" component={CatalogPage} />
                        <Route path="/" exact component={MainPage} />
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
