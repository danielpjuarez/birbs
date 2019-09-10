import React, {useEffect} from 'react';
import {Container} from 'react-bootstrap';
import {useSelector, useDispatch} from "react-redux";
import {getSightingsBySightingUserProfileId} from "../../shared/actions/birdSpeciesSighting";

export const Sighting = () => {

	// grab the profile id from the currently logged in account, or null if not found
	//const userProfileId = UseJwtProfileId();

	// Return the profile by profileId from the redux store
	/*const sightings = sighting.sighting ? [...userPosts.posts] : [];*/
	/*const birdSpecies = userPosts.user ? {...userPosts.user} : null;*/
	const sighting = useSelector(state => (state.birdSpeciesSightings ? state.sighting[0] : []));
	console.log(sighting);

	const dispatch = useDispatch();

	const effects = () => {
		dispatch(getSightingsBySightingUserProfileId());
	};

	const inputs = [];
	useEffect(effects, inputs);

	return (
		<>
			<Container>
				<h1>Sighting</h1>
				/**<div>
					<span>Photo: {sighting && sighting.sightingBirdPhoto}</span>
				</div>
				<div>
					<span>Common Name: {birdSpeciesSighting && species.comName}</span>
				</div>
				<div>
					<span>Scientific Name: {birdSpeciesSighting && species.sciName}</span>
				</div>
				<div>
					<span>Date: {sighting && sighting.sightingDate}</span>
				</div>
				<div>
					<p>Time: {sighting && sighting.sightingTime}</p>
				</div>
				<div>
					<span>Location: {sighting && sighting.sightingLocation}</span>
				</div>**/
			</Container>
		</>
	);
};

export default Sighting;