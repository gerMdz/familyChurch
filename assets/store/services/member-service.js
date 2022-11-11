import axios from 'axios';

/**
 * Makes a POST call to create a purchase object after checkout
 *
 * @param {Object} data
 * @return {Promise}
 */
export function saveMember(data) {
    return axios.post('https://127.0.0.1/api/members', data);
}
