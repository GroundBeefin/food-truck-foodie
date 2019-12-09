import React, {useEffect} from "react";
import {useDispatch, useSelector} from "react-redux";
import {getAllTrucks} from "../shared/actions/truck";
import Card from "react-bootstrap/Card";


export const Home = () => {
	const trucks = useSelector(state => state.trucks);
	const dispatch = useDispatch();

	const effects = () => {
		dispatch(getAllTrucks());
	};

	const inputs = [];

	useEffect(effects, inputs);

	return (
		<>
			{trucks.map(truck => {
				return (
					<Card style={{width: '18rem'}} key={truck.truckId}>
						<Card.Img variant="top" src={truck.truckAvatarUrl}/>
						<Card.Body>
							<Card.Text>{truck.truckName}</Card.Text>
							<Card.Text>{truck.truckMenuUrl}</Card.Text>
							<Card.Text>{truck.truckFoodType}</Card.Text>
						</Card.Body>
					</Card>)
			})}
		</>
	)
};
