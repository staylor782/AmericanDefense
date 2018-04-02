var app = angular.module('AmDef');

app.controller('classCtrl', function($scope){
  $scope.classes = [
    "Pistol Instruction",
    "Rifle Instruction",
    "Personal Protection in the Home",
    "Personal Protection outside the Home"
  ];
});