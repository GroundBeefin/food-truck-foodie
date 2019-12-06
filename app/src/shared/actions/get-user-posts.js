// import {httpConfig} from "../misc/http-config";
//
// export const getUserPosts = (userId) => async dispatch => {
// 	const {data} = await httpConfig(`/apis/users/?postUserId=${userId}`);
// 	dispatch({type: "GET_USER_POSTS", payload: data })
// };

import {httpConfig} from "../misc/http-config";

export const getUserPosts = (postId) => async dispatch => {
	const {data} = await httpConfig(`/apis/post/?postId=${userId}`);
	dispatch({type: "GET_USER_POSTS", payload: data })
};