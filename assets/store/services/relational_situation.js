import axios from 'axios';
/**
 * Gets the relational_situation information from our database
 *
 * @return {Promise}
 */
export function fetchRelationalSituation() {
    return axios({
        method: 'get',
        url: '/api/relational_situation',
    });
}
