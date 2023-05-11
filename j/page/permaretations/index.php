<main>
	<div class="txt center">
		<label for=permaretation>permaretations</label> <br>
		<input id=permaretation type=text> <br>
	</div>

	<div id=permaretations class="txt center"></div>
</main>

<script>
let input = document.getElementById('permaretation');
let output = document.getElementById('permaretations');

function array_permutations(arr) {
	if (arr.length == 1) {
		return arr;
	}
	let ret = [];
	for (let i = 0; i < arr.length; i++) {
		let permutation = [arr[i]];
		let remaining = [];
		for (let j = 0; j < arr.length; j++) {
			if (j != i) {
				remaining.push(arr[j]);
			}
		}
		let remaining_permutations = array_permutations(remaining);
		for (let j = 0; j < remaining_permutations.length; j++) {
			ret.push(permutation.concat(remaining_permutations[j]));
		}
	}
	return ret;
}

function string_permutations(str) {
	return array_permutations(str.split('')).map(function(arr) {
		return arr.join('');
	});
}

input.addEventListener('input', function() {
	let permaretations = string_permutations(input.value);
	output.innerHTML = '';
	for (let i = 0; i < permaretations.length; i++) {
		let div = document.createElement('div');
		div.innerHTML = permaretations[i];
		output.appendChild(div);
	}
});
</script>
