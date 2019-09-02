<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('traffic_channels', function(Blueprint $table) {
			$table->foreign('traffic_channel_type_id')->references('id')->on('traffic_channel_types')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('messages', function(Blueprint $table) {
			$table->foreign('traffic_channel_id')->references('id')->on('traffic_channels')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('messages', function(Blueprint $table) {
			$table->foreign('message_owner_id')->references('id')->on('message_owners')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('open_reports', function(Blueprint $table) {
			$table->foreign('incident_category')->references('id')->on('incident_categories')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('regions', function(Blueprint $table) {
			$table->foreign('country_id')->references('id')->on('countries')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('districts', function(Blueprint $table) {
			$table->foreign('region_id')->references('id')->on('regions')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('observers', function(Blueprint $table) {
			$table->foreign('polling_station_id')->references('id')->on('polling_stations')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('polling_stations', function(Blueprint $table) {
			$table->foreign('district_id')->references('id')->on('districts')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('constituencies', function(Blueprint $table) {
			$table->foreign('district_id')->references('id')->on('districts')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('candidates', function(Blueprint $table) {
			$table->foreign('constituency_id')->references('id')->on('constituencies')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('candidates', function(Blueprint $table) {
			$table->foreign('gender_id')->references('id')->on('genders')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('candidates', function(Blueprint $table) {
			$table->foreign('political_party_id')->references('id')->on('political_parties')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('candidate_results', function(Blueprint $table) {
			$table->foreign('polling_station_id')->references('id')->on('polling_stations')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('candidate_results', function(Blueprint $table) {
			$table->foreign('candidate_id')->references('id')->on('candidates')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('presidential_candidates', function(Blueprint $table) {
			$table->foreign('country_id')->references('id')->on('countries')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('traffic_channels', function(Blueprint $table) {
			$table->dropForeign('traffic_channels_traffic_channel_type_id_foreign');
		});
		Schema::table('messages', function(Blueprint $table) {
			$table->dropForeign('messages_traffic_channel_id_foreign');
		});
		Schema::table('messages', function(Blueprint $table) {
			$table->dropForeign('messages_message_owner_id_foreign');
		});
		Schema::table('open_reports', function(Blueprint $table) {
			$table->dropForeign('open_reports_incident_category_foreign');
		});
		Schema::table('regions', function(Blueprint $table) {
			$table->dropForeign('regions_country_id_foreign');
		});
		Schema::table('districts', function(Blueprint $table) {
			$table->dropForeign('districts_region_id_foreign');
		});
		Schema::table('observers', function(Blueprint $table) {
			$table->dropForeign('observers_polling_station_id_foreign');
		});
		Schema::table('polling_stations', function(Blueprint $table) {
			$table->dropForeign('polling_stations_district_id_foreign');
		});
		Schema::table('constituencies', function(Blueprint $table) {
			$table->dropForeign('constituencies_district_id_foreign');
		});
		Schema::table('candidates', function(Blueprint $table) {
			$table->dropForeign('candidates_constituency_id_foreign');
		});
		Schema::table('candidates', function(Blueprint $table) {
			$table->dropForeign('candidates_gender_id_foreign');
		});
		Schema::table('candidates', function(Blueprint $table) {
			$table->dropForeign('candidates_political_party_id_foreign');
		});
		Schema::table('candidate_results', function(Blueprint $table) {
			$table->dropForeign('candidate_results_polling_station_id_foreign');
		});
		Schema::table('candidate_results', function(Blueprint $table) {
			$table->dropForeign('candidate_results_candidate_id_foreign');
		});
		Schema::table('presidential_candidates', function(Blueprint $table) {
			$table->dropForeign('presidential_candidates_country_id_foreign');
		});
	}
}