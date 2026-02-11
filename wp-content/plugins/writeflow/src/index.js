import { registerPlugin } from '@wordpress/plugins';
import { PluginSidebar } from '@wordpress/edit-post';
import { PanelBody } from '@wordpress/components';
import { Fragment } from '@wordpress/element';
import { Sidebar } from './sidebar';

registerPlugin( 'writeflow-sidebar', {
    render: () => (
        <PluginSidebar
            name="writeflow-sidebar"
            title="WriteFlow"
            >
            <Sidebar />
        </PluginSidebar>
    )});