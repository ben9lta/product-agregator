import React from 'react';
import './index.scss';
import Cart from "../cart";
import {connect} from "react-redux";

const Header = ({productsLength}) => {
    React.useEffect(() => {
    }, []);

    const refToggleUser = React.useRef(null);
    const [cartOpened, setCartOpened] = React.useState(false);

    React.useEffect(() => {
        $('.dropdown-toggle').dropdown();
    }, [])

    const handleClickCart = (e) => {
        e.preventDefault();
        setCartOpened(!cartOpened);
    }

    return (
        <header>
            <nav className="navbar navbar-light bg-light justify-content-between">
                <a className="navbar-brand">Продукты в Ялте</a>

                <ul className="navigation">
                    <li><a href="/">Главная</a></li>
                    <li><a href="/catalog">Каталог</a></li>
                    <li><a href="/about">О нас</a></li>
                </ul>
                <ul className="nav">
                    <form method="get" action="" className="search-product">
                        <input type="search" name="search-product" placeholder="Поиск"/>
                        <input type="submit" value="Найти"/>
                    </form>
                </ul>

                <ul className="nav">
                    <li className={'nav-item cart-item'}>
                        <a href="#" onClick={handleClickCart}>
                            <svg width="20" height="23" viewBox="0 0 27 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 1H4.125L7.25 15.6087H23.3214L26 5.56522H7.25" stroke="#2B2B2B" strokeOpacity="0.75" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"/>
                                <ellipse cx="10.8215" cy="19.7174" rx="2.23214" ry="2.28261" stroke="#2B2B2B" strokeOpacity="0.75" strokeWidth="2"/>
                                <ellipse cx="19.75" cy="19.7174" rx="2.23214" ry="2.28261" stroke="#2B2B2B" strokeOpacity="0.75" strokeWidth="2"/>
                            </svg>
                            <span className={'counter'} hidden={!productsLength}>{productsLength}</span>
                        </a>
                        <div className={cartOpened ? 'open cart-wrapper' : 'cart-wrapper'} >
                            <Cart handleClickCart={handleClickCart}/>
                        </div>
                    </li>
                    {!user ? (
                        <>
                            <li className="nav-item">
                                <a className="nav-link" href="/login">Вход</a>
                            </li>

                            <li className="nav-item">
                                <a className="nav-link" href="/register">Регистрация</a>
                            </li>
                        </>
                    ) : (
                        <li className="nav-item dropdown">
                            <a id="navbarDropdown" ref={refToggleUser} className="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {user.name}
                            </a>
                            <div className="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a className="nav-link form-inline dropdown-item" href="/logout">Выйти</a>
                            </div>
                        </li>
                    )}

                </ul>
            </nav>

        </header>
    )
}

const mapStateToProps = (state) => {
    return {
        productsLength: state.cartReducer.cart.products.length,
    }
}

export default connect(mapStateToProps, {})(Header);
// export default Header;
