import { Button, Notice } from "@wordpress/components";

const DraftStep = ( { onNext, onBack } ) => {
    return (
        <>
            <Notice status="info">
                Expand each outline point into 2–4 paragraphs.
                Focus on clarity, not perfection.
            </Notice>
            <div style={{ marginTop: '16px' }}>
                <Button variant="secondary" onClick={onBack} style={{ marginRight: '8px' }}>← Back to Outline</Button>
                <Button variant="primary" onClick={onNext}>Proceed to Checklist →</Button>
            </div>
        </>
    );
};