import { Button, Notice, Spinner } from "@wordpress/components";
import { useDispatch, useSelect } from '@wordpress/data';
import apiFetch from '@wordpress/api-fetch';
import { useState } from '@wordpress/element';

const DraftStep = ( { onNext, onBack } ) => {

    const meta = useSelect( ( select ) => select( 'core/editor' ).getEditedPostAttribute( 'meta' ) );

    const { editPost } = useDispatch( 'core/editor' );
    const { insertBlocks } = useDispatch( 'core/block-editor' );
    const [ isLoading, setIsLoading ] = useState( false );

    const expandDraft = async () => {
        if (!meta._writeflow_outline) {
            alert ("Please provide an outline before expanding the draft.");
            return;
        }

        setIsLoading( true );
        
        const response = await apiFetch( {
            path: '/wp/v1/writeflow/expand-draft',
            method: 'POST',
            data: {
                outline: meta._writeflow_outline,
            },
        } );
        
        const content = wp.blocks.rawHandler({ HTML:response.expanded_draft });

        insertBlocks( content );
        setIsLoading( false );
    };

    return (
        <>
            <Notice status="info">
                Expand each outline point into 2–4 paragraphs.
                Focus on clarity, not perfection.
                AI will expand your outline into a structured article.
            </Notice>
            <div style={{ marginTop: '16px' }}>
                <Button variant="secondary" onClick={onBack} style={{ marginRight: '8px' }}>← Back to Outline</Button>
                <Button variant="secondary" onClick={expandDraft} disabled={isLoading} style={{ marginRight: '8px' }}>
                    { isLoading ? <Spinner /> : '[AI] Expand Draft' }
                </Button>
                <Button variant="primary" onClick={onNext}>Proceed to Checklist →</Button>
            </div>
        </>
    );
};
export default DraftStep;