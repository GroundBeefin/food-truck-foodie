import React, {useEffect} from "react";
import {useDispatch, useSelector} from "react-redux";
import {getAllTrucks} from "../shared/actions/truck";
import Card from "react-bootstrap/Card";
import Jumbotron from "react-bootstrap/Jumbotron";
import Image from "react-bootstrap/Image";
import MainFTFlogo5 from "../images/MainFTFLogo5.png";


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
			<container-fluid>
				<Jumbotron>
					<div className="d-flex justify-content-center">
						<Image src={MainFTFlogo5} fluid alt="logo"/>
					</div>
				</Jumbotron>
				<div className="d-flex justify-content-center  my-3 py-3">
					<h1>LOCAL TRUCKS</h1>
				</div>
			</container-fluid>
			{trucks.map(truck => {
				return (
					<container-fluid>
						<div className="d-flex justify-content-center  mb-3 pb-3">
							<Card style={{width: '20rem'}} key={truck.truckId}>
								<Card.Body>
									<Card.Img variant="top" src={truck.truckAvatarUrl}/>
									<Card.Text>{truck.truckName}</Card.Text>
									<Card.Text>{truck.truckFoodType}</Card.Text>
								</Card.Body>
							</Card>
						</div>
						<br />
					</container-fluid>)
			})}
		</>
	)
};
