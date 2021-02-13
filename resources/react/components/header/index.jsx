import React from 'react';
import './index.scss';

const Header = () => {
    const refToggleUser = React.useRef(null);

    React.useEffect(() => {
        $('.dropdown-toggle').dropdown()
    }, [])


    const handleLogout = (e) => {
        console.log('its ok');
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
                                <a className="nav-link form-inline dropdown-item" href="/logout"
                                   onClick={handleLogout}>Выйти
                                </a>
                            </div>
                        </li>
                    )}

                </ul>
            </nav>

        </header>
    )
}

export default Header;
