import {httpConfig} from "../utils/http-config";

export const getUserByUserId = () => async (dispatch) => {
	const payload = await httpConfig.get("/apis/user/");
	dispatch({type: "GET_USER",payload : payload.data });
};