import {httpConfig} from "../utils/http-config";

export const getAllUsers = () => async dispatch => {
	const {data} = await httpConfig('/apis/user/');
	dispatch({type: "GET_ALL_USERS", payload: data })
};

export const getUserByUserId = (id) => async dispatch => {
	const {data} = await httpConfig(`/apis/user/${id}`);
	dispatch({type: "GET_USER_BY_USER_ID", payload: data })
};

export const getUserByUserEmail = (email) => async dispatch => {
	const {data} = await httpConfig(`/apis/user/?userEmail=${email}`);
	dispatch({type: "GET_USER_BY_USER_EMAIL", payload: data })
};