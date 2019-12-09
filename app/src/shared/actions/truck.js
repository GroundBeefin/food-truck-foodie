import {httpConfig} from "../utils/http-config";

export const getAllTrucks = () => async (dispatch) => {
	const payload = await httpConfig.get("/apis/truck/");
	dispatch({type: "GET_ALL_TRUCKS",payload : payload.data });
};