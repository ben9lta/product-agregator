import React from 'react';

const Sidebar = ({direction = 'left', children}) => {
    return (
        <div className={`sidebar sidebar-${direction}`}>
            {children}
        </div>
    );
}

export default Sidebar;
