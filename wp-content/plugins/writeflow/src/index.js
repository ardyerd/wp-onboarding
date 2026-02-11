import { registerPlugin } from '@wordpress/plugins';
import { PluginSidebar } from '@wordpress/editor';
import Sidebar from './sidebar';

registerPlugin( 'writeflow-sidebar', {
    render: () => (
        <PluginSidebar
            name="writeflow-sidebar"
            title="WriteFlow"
            >
            <Sidebar />
        </PluginSidebar>
    )});
