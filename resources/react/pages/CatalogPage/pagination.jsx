import React from 'react';

const Pagination = ({handlePagination, pagination: {meta, links}, maxPages = 0}) => {
    const [pages, setPages] = React.useState([]);
    const [templateLink, setTemplateLink] = React.useState(null);
    const [classLeftPagination, setClassLeftPagionation] = React.useState('');
    const [classRightPagination, setClassRightPagination] = React.useState('');

    React.useEffect(() => {
        let array = [];

        if(meta) {
            const {current_page, last_page} = meta;
            setClassLeftPagionation(current_page === 1 ? 'page-link disabled' : 'page-link');
            setClassRightPagination(current_page === last_page ? 'page-link disabled' : 'page-link');
            setTemplateLink(links.first.slice(0, -1));

            let current = 1;
            const pageCountBetween = Math.floor(maxPages / 2);
            const max = last_page - pageCountBetween;
            if (last_page < maxPages || current_page <= pageCountBetween) {
                current = 1;
            } else if (current_page > max) {
                current = last_page - maxPages + 1;
            } else {
                current = current_page - pageCountBetween;
            }

            for(let i = current; i < current + maxPages; i++) {
                if(i > last_page) break;
                array.push(i);
            }
        }
        setPages(array);
    }, [handlePagination])

    return (
        <ul className={'pagination'} hidden={meta.last_page < 2}>
            <li className={'page-item'}><a className={`first-link ${classLeftPagination}`} onClick={handlePagination} href={links.first}><img src={'/icons/two-dir.svg'} /></a></li>
            <li className={'page-item'}><a className={`prev-link ${classLeftPagination}`} onClick={handlePagination} href={links.prev}><img src={'/icons/one-dir.svg'} /></a></li>

            {pages.map((page, key) => {
                const className = meta.current_page === page ? 'page-link active' : 'page-link';
                return (
                    <li className={'page-item'} key={key}>
                        <a className={className} onClick={handlePagination} href={templateLink.concat(page)}>
                            {page}
                        </a>
                    </li>
                )
            })}

            <li className={'page-item'}><a className={`next-link ${classRightPagination}`} onClick={handlePagination} href={links.next}><img src={'/icons/one-dir.svg'} /></a></li>
            <li className={'page-item'}><a className={`last-link ${classRightPagination}`} onClick={handlePagination} href={links.last}><img src={'/icons/two-dir.svg'} /></a></li>
        </ul>
    )
}

export default Pagination;
